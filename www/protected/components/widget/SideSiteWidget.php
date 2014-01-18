<?php 

class SideSiteWidget extends CWidget {

    public function run()
    {
        $site['post'] = Post::model()->count();
        $site['user'] = User::model()->count();
        $site['comment'] = Comment::model()->count();
        
        $this->render("sidesite", array(
            "site" => $site,
        ));
    }
}