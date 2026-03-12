<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
     /*
    =========================
    SIMPAN TEAM + MEMBER
    =========================
    */
    public function store(Request $request)
    {
        $request->validate([
            'nama_team' => 'required',
            'status' => 'required',
            'ketua_id' => 'required|exists:users,id',
            'members' => 'nullable|array'
        ]);

        /*
        ===================================
        CEK KETUA BELUM PUNYA TEAM
        ===================================
        */
        $ketua = User::find($request->ketua_id);

        if ($ketua->ketuaTeams()->exists() || $ketua->teams()->exists()) {
            return back()->withErrors('Ketua sudah tergabung di team lain');
        }

        /*
        ===================================
        CEK MEMBER BELUM PUNYA TEAM
        ===================================
        */
        if ($request->members) {
            foreach ($request->members as $id) {
                $user = User::find($id);

                if ($user->ketuaTeams()->exists() || $user->teams()->exists()) {
                    return back()->withErrors('Ada member yang sudah punya team lain');
                }
            }
        }

        $team = Team::create([
            'nama_team' => $request->nama_team,
            'ketua_id' => $request->ketua_id,
            'status' => $request->status,
        ]);

        if ($request->members) {
            $team->members()->attach($request->members);
        }
        return redirect()->route('team')->with('success', 'Team berhasil dibuat');
    }

    public function getUserDetail($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    
    public function edit($id)
    {
        $team = Team::with(['members','ketua'])->findOrFail($id);

        $users = User::where('role','petugas')
            ->where('status','aktif')
            ->get();

        $teamUsers = DB::table('team_members')
            ->pluck('team_id','user_id');

        $ketuaTeams = DB::table('teams')
            ->pluck('id','ketua_id');

        return view('admin.master.team.edit-team', compact('team','users','teamUsers', 'ketuaTeams'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'ketua_id' => 'required|exists:users,id',
            'members'  => 'array'
        ]);

        DB::transaction(function () use ($request, $team) {

            $ketuaBaru   = $request->ketua_id;
            $membersBaru = $request->members ?? [];

            /*
            =========================================
            JANGAN BIARKAN KETUA JADI MEMBER
            =========================================
            */
            $membersBaru = array_diff($membersBaru, [$ketuaBaru]);


            /*
            =========================================
            1️⃣ HANDLE KETUA PINDAH (SWITCH LEADER)
            =========================================
            */
            $teamLamaKetua = Team::where('ketua_id', $ketuaBaru)
                ->where('id','!=',$team->id)
                ->first();

            if ($teamLamaKetua) {

                $pengganti = $teamLamaKetua->members()->first();

                if ($pengganti) {
                    $teamLamaKetua->ketua_id = $pengganti->id;
                    $teamLamaKetua->members()->detach($pengganti->id);
                } else {
                    $teamLamaKetua->ketua_id = null;
                }

                $teamLamaKetua->save();
            }


            /*
            =========================================
            2️⃣ JIKA DIA MASIH JADI ANGGOTA TEAM LAIN
            (ANGGOTA ➜ KETUA)
            =========================================
            */
            DB::table('team_members')
                ->where('user_id', $ketuaBaru)
                ->delete();


            /*
            =========================================
            3️⃣ UPDATE KETUA TEAM INI
            =========================================
            */
            $team->ketua_id = $ketuaBaru;
            $team->save();


            /*
            =========================================
            4️⃣ HANDLE MEMBER SWITCH
            =========================================
            */
            foreach ($membersBaru as $userId) {

                // kalau dia ketua di team lain → turunkan dulu
                $teamKetuaLain = Team::where('ketua_id', $userId)
                    ->where('id','!=',$team->id)
                    ->first();

                if ($teamKetuaLain) {

                    $pengganti = $teamKetuaLain->members()->first();

                    if ($pengganti) {
                        $teamKetuaLain->ketua_id = $pengganti->id;
                        $teamKetuaLain->members()->detach($pengganti->id);
                    } else {
                        $teamKetuaLain->ketua_id = null;
                    }

                    $teamKetuaLain->save();
                }

                // hapus membership lama
                DB::table('team_members')
                    ->where('user_id', $userId)
                    ->delete();
            }


            /*
            =========================================
            5️⃣ SYNC MEMBER BARU
            =========================================
            */
            $team->members()->sync($membersBaru);
        });

        return redirect()->route('team')
            ->with('success','Team berhasil diupdate');
    }

}