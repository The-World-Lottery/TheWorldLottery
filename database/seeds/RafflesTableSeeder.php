<?php

use Illuminate\Database\Seeder;

class RafflesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 0;$i <= 12;$i++) 
        {
           	$raffle= new \App\Models\Raffle();
            $raffle->title = 'Raffle #'. $i;
            $raffle->content = 'for charity'.$i;
            $raffle->product ='A product donated by company # '.$i . ' to advertise their business.';
           if($i < 9)
           {
            	$raffle->end_date = date("Y-m-d ") .'0'. $i .':00:00';
        	}
        	else
            {
        		$raffle->end_date = date("Y-m-d ") . $i .':00:00';
        	}

            $raffle->user_id = 1;
            $raffle->save();
        }
        
        $day = 5;
        $month = 12;
        
        $raffle1= new \App\Models\Raffle();
        $raffle1->title = 'A Day With Samuel L. Jackson';
        $raffle1->content = 'Hilarity for Charity';
        $raffle1->product ='Samuel L. Jackson has put aside a day for the winner to shadow him on the set of Avengers 4!';
        $raffle1->end_date = date("Y-").$month ."-" . ($day+1 )." 09:00:00";
        $raffle1->img = "/images/samuel.jpg";
        $raffle1->user_id = 1;
        $raffle1->save();

        $raffle2= new \App\Models\Raffle();
        $raffle2->title = '2018 Corvette Stingray';
        $raffle2->content = 'The World Lottery Foundation';
        $raffle2->product ='Chevrolet has donated one of their new 2018 Stingrays for us to raffle off.';
        $raffle2->end_date = date("Y-").$month ."-" . ($day+2 ) ." 12:00:00";
        $raffle2->img = "/images/corvette.png";
        $raffle2->user_id = 1;
        $raffle2->save();

        $raffle10= new \App\Models\Raffle();
        $raffle10->title = 'Trip to Fiji (for 5)';
        $raffle10->content = 'GCI Foundation';
        $raffle10->product ='Radisson Blu Resort Fiji Denarau Island has donated an all expense paid, 5 day trip.';
        $raffle10->end_date = date("Y-").$month ."-" . ($day+3 ) ." 08:00:02";
        $raffle10->img = "/images/fiji.jpg";
        $raffle10->user_id = 1;
        $raffle10->save();

        $raffle11= new \App\Models\Raffle();
        $raffle11->title = 'Blue Chrome Nissan GT-R';
        $raffle11->content = 'GCI Foundation';
        $raffle11->product ='Nissan has donated one of their new gt-rs to be auctioned off';
        $raffle11->end_date = date("Y-").$month ."-" . ($day+4 ) ." 10:00:00";
        $raffle11->img = "/images/nissan.jpg";
        $raffle11->user_id = 1;
        $raffle11->save();

        $raffle3= new \App\Models\Raffle();
        $raffle3->title = 'Music Video Appearance';
        $raffle3->content = 'The World Lottery Foundation';
        $raffle3->product ='Justin Beiber has offered to include one fan in his next music videos';
        $raffle3->end_date = date("Y-").$month ."-" . ($day+5 ) ." 11:50:00";
        $raffle3->img = "/images/justin.png";
        $raffle3->user_id = 1;
        $raffle3->save();

        $raffle4= new \App\Models\Raffle();
        $raffle4->title = '4 days at Disney Land (for 4)';
        $raffle4->content = 'American Cancer Society';
        $raffle4->product ='Disney Land has donated an all-expense-paid visit to their amazing park!';
        $raffle4->end_date = date("Y-").$month ."-" . ($day+6 ) ." 12:00:00";
        $raffle4->img = "/images/disney.png";
        $raffle4->user_id = 1;
        $raffle4->save();

        $raffle5= new \App\Models\Raffle();
        $raffle5->title = 'Lifetime Dave & Busters Gamecard';
        $raffle5->content = 'The World Lottery Foundation';
        $raffle5->product ='D&B has donated a one-of-a-kind limitless gamecard';
        $raffle5->end_date = date("Y-").$month ."-" . ($day+7 ) ." 11:45:00";
        $raffle5->img = "/images/dandb.png";
        $raffle5->user_id = 1;
        $raffle5->save();

        $raffle6= new \App\Models\Raffle();
        $raffle6->title = 'Tesla Sport';
        $raffle6->content = 'Tesla Foundation';
        $raffle6->product ='Tesla had donated their newest sportscar model';
        $raffle6->end_date = date("Y-").$month ."-" . ($day+8 ) ." 12:00:00";
        $raffle6->img = "/images/tesla2.jpeg";
        $raffle6->user_id = 1;
        $raffle6->save();

        $raffle7= new \App\Models\Raffle();
        $raffle7->title = 'CodeUp Bootcamp Entry';
        $raffle7->content = 'GCI Foundation';
        $raffle7->product ='CodeUp has donated one entry into their next Java class. Valued at $22,500.00';
        $raffle7->end_date = date("Y-").$month ."-" . ($day+9 ) ." 12:00:00";
        $raffle7->img = "/images/codeup.jpg";
        $raffle7->user_id = 1;
        $raffle7->save();

        $raffle8= new \App\Models\Raffle();
        $raffle8->title = 'All expense paid trip to Hawaii';
        $raffle8->content = 'GCI Foundation';
        $raffle8->product ='A five night stay at Ko"a Kea Hotel Resort at Poipu Beach';
        $raffle8->end_date = date("Y-").$month ."-" . ($day+10)  ." 11:30:00";
        $raffle8->img = "/images/hawaii.png";
        $raffle8->user_id = 1;
        $raffle8->save();

        $raffle8= new \App\Models\Raffle();
        $raffle8->title = 'KISS Ticket & Backstage Pass (x4)';
        $raffle8->content = 'GCI Foundation';
        $raffle8->product ='Kiss has donated 4 all access passes for their next show in Washington. Transport provided as well.';
        $raffle8->end_date = date("Y-").$month ."-" . ($day+11)  ." 11:11:00";
        $raffle8->img = "/images/kiss.jpg";
        $raffle8->user_id = 1;
        $raffle8->save();

        $raffle9= new \App\Models\Raffle();
        $raffle9->title = 'KB Homes House';
        $raffle9->content = 'GCI Foundation';
        $raffle9->product ='KB Homes has donated a fully built house valued at $260,000, in Austin, Texas';
        $raffle9->end_date = date("Y-").$month ."-" . ($day+12) ." 11:00:00";
        $raffle9->img = "/images/home.jpg";
        $raffle9->user_id = 1;
        $raffle9->save();

        $raffle10= new \App\Models\Raffle();
        $raffle10->title = 'On the set with Chris Pratt';
        $raffle10->content = 'Save the Dinosaurs';
        $raffle10->product ='Chris Pratt has donated a day for a lucky fan to view the filming of Jurassic World 3!';
        $raffle10->end_date = date("Y-").$month ."-" . ($day) ." 11:00:00";
        $raffle10->img = "/images/chris.jpg";
        $raffle10->user_id = 1;
        $raffle10->save();

        $raffle11= new \App\Models\Raffle();
        $raffle11->title = 'Skii day with Shaun White';
        $raffle11->content = 'Slopes Up';
        $raffle11->product ='While Mr.White is in Denver Colorado he has set aside a day to just hang out on the slopes with a lucky fan (winner must be able to skii or snowboard)';
        $raffle11->end_date = date("Y-").$month ."-" . ($day+4) ." 11:00:00";
        $raffle11->img = "/images/sean.jpg";
        $raffle11->user_id = 1;
        $raffle11->save();

        $raffle12= new \App\Models\Raffle();
        $raffle12->title = 'First Civilian Ticket to Mars';
        $raffle12->content = 'Get us off this rock foundation';
        $raffle12->product ='Space X has donated the very first civilian ticket to Mars.';
        $raffle12->end_date = date("Y-").$month ."-" . ($day) ." 01:00:00";
        $raffle12->img = "/images/mars.jpg";
        $raffle12->user_id = 1;
        $raffle12->save();

        $raffle13= new \App\Models\Raffle();
        $raffle13->title = '4 day trip to Vegas (x4)';
        $raffle13->content = 'Poor Green Whale Guns Books';
        $raffle13->product ='4 days and 4 nights stay donated by Caesars Palace. All expenses paid + $1000 gambling money per night, per person';
        $raffle13->end_date = date("Y-").$month ."-" . ($day+13) ." 01:00:00";
        $raffle13->img = "/images/vegas.jpg";
        $raffle13->user_id = 1;
        $raffle13->save();

    }
}
