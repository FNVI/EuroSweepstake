<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
        <title>Euro Sweepstake</title>
    </head>
    <body>
        
        
        
        <?php
            include 'engine.php';
            
            $groups = [
                "Albania"=>"al",
                "France"=>"fr",
                "Romania"=>"ro",
                "Switzerland"=>"ch",
                "England"=>"gb-eng",
                "Russia"=>"ru",
                "Slovakia"=>"sk",
                "Wales"=>"gb-wls",
                "Germany"=>"de",
                "Northern Ireland"=>"gb-nir",
                "Poland"=>"pl",
                "Ukraine"=>"ua",
                "Croatia"=>"hr",
                "Czech Republic"=>"cz",
                "Spain"=>"es",
                "Turkey"=>"tr",
                "Belgium"=>"be",
                "Italy"=>"it",
                "Republic of Ireland"=>"ie",
                "Sweden"=>"se",
                "Austria"=>"at",
                "Hungary"=>"hu",
                "Iceland"=>"is",
                "Portugal"=>"pt"
            ];

            $players = filter_input(INPUT_GET, "players", FILTER_SANITIZE_STRING);
            $people = array_map("trim",explode(",", $players));
            
            $sweeps = new Sweepstakes(array_keys($groups), $people);
        ?>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <i class="navbar-brand fa-2x flag-icon flag-icon-eu"></i>
                <p class="navbar-text">FNVi Euro 2016 sweepstakes</p>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="jumbotron">
                        <h1>Welcome to the sweepstakes generator!</h1>
                        <p>Add the players in the text box separated by commas.</p>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2">
                                    Players
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="players" value="<?php echo $players; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php if(count($people) && trim($players)){ ?>
            <div class="row">
                <?php foreach($sweeps as $user=>$teams){ ?>
                <fieldset class="col-xs-6 col-md-4">
                    <legend><?php echo $user; ?></legend>
                    <ul class="list-group">
                        <?php foreach ($teams as $team){ ?>
                        <li class="list-group-item">
                            <?php $flag = "flag-icon-".$groups[$team]; ?>
                            <i class="flag-icon <?php echo $flag; ?>"></i>
                            
                            <?php echo $team; ?>
                        </li>
                        <?php } ?>
                    </ul>
                </fieldset>
                <?php } ?>
                <?php if($sweeps->remaining()){ ?>
                <fieldset class="col-xs-6 col-md-4">
                    <legend>Nobody</legend>
                    <ul class="list-group">
                        <?php foreach ($sweeps->remaining() as $team){ ?>
                        <li class="list-group-item">
                            <?php $flag = "flag-icon-".$groups[$team]; ?>
                            <i class="flag-icon <?php echo $flag; ?>"></i>
                            
                            <?php echo $team; ?>
                        </li>
                        <?php } ?>
                    </ul>
                </fieldset>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
