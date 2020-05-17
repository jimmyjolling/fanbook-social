<?php

use App\Post;
use App\User;
use App\Comment;
use App\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('posts')->truncate();
        DB::table('profiles')->truncate();
        DB::table('social_identities')->truncate();
        DB::table('users')->truncate();

        // function to generate comments
        function commentGenerator($post_id) {
            for ($i=0; $i < rand(2,3); $i++) { 
                $comment = new Comment;
                $comment->body = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, deleniti necessitatibus voluptatibus cumque iure est sint quisquam quas ab. Sit quidem tempora delectus consequuntur quod itaque aspernatur saepe perspiciatis doloribus.';
                $comment->user_id = rand(1, 3);
                $comment->post_id = $post_id;
                $comment->save();
            }
        }
        //user 1
        $user1 = new User;
        $user1->name = "Dwayne Jhonson";
        $user1->email = "dwayne@hotmail.com";
        $user1->password = bcrypt('testing123');
        $user1->save();

        $profile = new Profile;
        $profile->user_id = $user1->id;
        $profile->name = $user1->name;
        $profile->work = "The gym";
        $profile->location = "los Angeles";
        $profile->heritage = "Hawai";
        $profile->relation_status = 0;
        $profile->image = "dwayne.jpg";
        $profile->save();

        $post = new Post;
        $post->title = 'How to stay fit';
        $post->content = "Success isn't always about 'Greatness', it's about consistency. Consistent, hard work gains success. Greatness will come.";
        $post->user_id = $user1->id;
        $post->save();
        commentGenerator($post->id);

        $post = new Post;
        $post->title = 'Motivational message';
        $post->content = "Success isn't always about 'Greatness', it's about consistency. Consistent, hard work gains success. Greatness will come.";
        $post->user_id = $user1->id;
        $post->save();
        commentGenerator($post->id);

        //User 2
        $user2 = new User;
        $user2->name = "Jason Statham";
        $user2->email = "jason@hotmail.com";
        $user2->password = bcrypt('testing123');
        $user2->save();

        $profile = new Profile;
        $profile->user_id = $user2->id;
        $profile->name = $user2->name;
        $profile->work = "Expendables";
        $profile->location = "los Angeles";
        $profile->heritage = "London";
        $profile->relation_status = 0;
        $profile->image = "jason.jpg";
        $profile->save();

        $post = new Post;
        $post->title = 'Throw a knife to your life';
        $post->content = "If you don't tell me what I need to know, I'm gonna press down on this chair until it crushes your trachea. Trust me, it's agonizing. Plus, there's the posthumous humiliation of having been killed with a chair.";
        $post->user_id = $user2->id;
        $post->save();
        commentGenerator($post->id);

        $post = new Post;
        $post->title = 'Dead machine';
        $post->content = "When I'm sober... When I'm healthy and well... I hurt people. I'm lethal. I drink to weaken the machine they made.";
        $post->user_id = $user2->id;
        $post->save();
        commentGenerator($post->id);

        //User 3
        $user3 = new User;
        $user3->name = "Hugh Jackman";
        $user3->email = "hugh@hotmail.com";
        $user3->password = bcrypt('testing123');
        $user3->save();

        $profile = new Profile;
        $profile->user_id = $user3->id;
        $profile->name = $user3->name;
        $profile->work = "Wolverine";
        $profile->location = "Miami";
        $profile->heritage = "The pack";
        $profile->relation_status = 0;
        $profile->image = "hugh.jpg";
        $profile->save();

        $post = new Post;
        $post->title = 'The list';
        $post->content = "Write down five things you love to do. Next, write down five things that you’re really good at. Then just try to match them up! Revisit your list once a year to make sure you’re on the right track.";
        $post->user_id = $user3->id;
        $post->save();
        commentGenerator($post->id);

        $post = new Post;
        $post->title = 'Life of an actor';
        $post->content = "Always think the great parts outlive the actors that play them and that’s a stage tradition, that goes back hundreds of years and it should be that way.";
        $post->user_id = $user3->id;
        $post->save();
        commentGenerator($post->id);
    }
}
