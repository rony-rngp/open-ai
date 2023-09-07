<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $keywords, $website_info, $post_ids;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($keywords, $website_info, $post_ids)
    {
        $this->keywords = $keywords;
        $this->website_info = $website_info;
        $this->post_ids = $post_ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->keywords as $key => $keyword){

            //ui post generate
            $introduction_text = post_generator($keyword, 'introduction');

            $conclusion_text = post_generator($keyword, 'conclusion');

            $generatedText = $introduction_text.$conclusion_text;
            //for create wordpress post
            $post_response = create_wp_post($keyword, $generatedText, $this->website_info);

            $post_data = Post::find($this->post_ids[$key]);
            if ($post_response == 201){
                $post_data->status = 'Success';
            }else{
                $post_data->status = 'Failed';
            }
            $post_data->update();
        }

    }
}
