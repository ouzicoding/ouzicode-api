<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Xunsearch;
use Illuminate\Console\Command;

class addSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $cur_time = time();
        $articles = Article::orderBy('id')
            ->select('id','title','keywords')
            ->get();
//        $res = Xunsearch::search('count');
//        $res = Xunsearch::clean();
//        p($res);die;
        foreach ($articles as $article) {
            Xunsearch::add([
                'id'=>$article->id,
                'title'=>$article->title,
                'keywords'=>$article->keywords,
                'chrono'=>$cur_time,
            ]);
        }

        return true;
    }
}
