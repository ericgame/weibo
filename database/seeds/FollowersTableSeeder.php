<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        $user=$users->first();
        $user_id=$user->id;

        //獲取去除掉 ID 為 1 的所有用戶 ID 陣列
        $followers=$users->slice(1);
        $follower_ids=$followers->pluck('id')->toArray();

        //1號用戶關注1號用戶以外的所有用戶
        $user->follow($follower_ids);

        //1號用戶以外的所有用戶，都來關注1號用戶
        foreach($followers as $follower){
            $follower->follow($user_id);
        }
    }
}
