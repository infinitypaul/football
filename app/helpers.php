<?php

function getFixtures($teamslist,$startDate,$referees, $id){

    $week = 1;
//if odd number of teams add a BYE team!
    if (count($teamslist)%2 != 0){
        array_push($teamslist,"IGNORE");
    }

//shuffle the list of teams, so we don't get same fixtures each time!
    shuffle($teamslist);

//split teamslist into two arrays
    $away = array_splice($teamslist,(count($teamslist)/2));
    $home = $teamslist;

//iterate through for every game in every round for teams
    for ($a=0; $a < ((count($teamslist)+count($away))-1)*2; $a++){

//assign the full list of referees each round or week so we get full list again
        $refs=$referees;

        //shuffle the list so its random
        shuffle($refs);
        for ($z=0; $z<count($home); $z++){

            //pick a ref for a game basically!
            $picked=array_shift($refs);


            //assign the relevant teams, dates, times and referee to fixtures

            if (($a%2 !=0) && ($z%2 ==0)){

                if ($z%2==0)
                {
                    $startDate=date('Y-m-d',strtotime($startDate."+1 days"));
                }


                $match[$a][$z]["home_id"]=$away[$z];
                $match[$a][$z]["away_id"]=$home[$z];
                $match[$a][$z]["date_played"]=$startDate;
                $match[$a][$z]["time_played"]="19:00:00";
                $match[$a][$z]["referee"]=$picked;
                $match[$a][$z]["season_id"]=$id;
                $match[$a][$z]["week"]=$week;


            } else {
                if ($z%2==0)
                {
                    $startDate=date('Y-m-d',strtotime($startDate."+1 days"));

                }

                $match[$a][$z]["home_id"]=$home[$z];
                $match[$a][$z]["away_id"]=$away[$z];
                $match[$a][$z]["date_played"]=$startDate;
                $match[$a][$z]["time_played"]="19:00:00";
                $match[$a][$z]["referee"]=$picked;
                $match[$a][$z]["season_id"]=$id;
                $match[$a][$z]["week"]=$week;
//                $match[$a][$z]["Home"]=$home[$z];
//                $match[$a][$z]["Away"]=$away[$z];
//                $match[$a][$z]["Date"]=$startDate;
//                $match[$a][$z]["Time"]="19:00:00";
//                $match[$a][$z]["Ref"]=$picked;

            }


        }

        //If there
        if(count($home)+count($away)-1 > 2){
            $splice=array_splice($home,1,1);
            $shift=array_shift($splice);
            array_unshift($away,$shift);
            array_push($home,array_pop($away));
        }


        $startDate=date('Y-m-d',strtotime($startDate."+7 days"));
        $week = $week+1;
    }






    //go through the whole array storing everything and go to each round, then game and check whether our bye team is present, if so ignore and remove the fixture,else keep it
    foreach($match AS $matchkey => $matchval)
    {

        foreach($matchval AS $gamekey=>$game){
            if($game["home_id"]!= "IGNORE" && $game["away_id"]!="IGNORE"){

                //store it all in a new multidimensional array
                $allmatches[$matchkey][$gamekey]=$game;

            }

        }

    }

//return it all
    return $allmatches;
}

function highScore(){
    $score = array(4, 5, 6);
    return $score[array_rand($score)];
}

function lowScore(){
    $score = array(1, 2, 3);
    return $score[array_rand($score)];
}
