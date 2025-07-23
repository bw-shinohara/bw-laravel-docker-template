<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 作成したシーダークラスを実行する（artisanコマンドを用いることで）
        $this->call([
            TodoSeeder::class,
        ]);
    }
}
