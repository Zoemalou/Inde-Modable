 <?php     if(isset($_POST["+"])) {
     $nbrejeux = 12;
    }
    $games = $this->get_top_steam_games($nbrejeux);