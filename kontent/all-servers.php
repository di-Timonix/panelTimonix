<?php

	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		wszystkie pliki timonix.pl
	
	*/
	
	// ładowanie rdzenia arads
	require_once("arads.php");
	
	$all_aplication = $db->query("SELECT * FROM `arads_serwer`");
	
?>

	<section class="tsr background-white tsr-p-5px tsr-border-radius10px">
		Data Center
	</section>
	
	<section class="tsr tsr-display-flex tsr-flex-wrap tsr-justify-content-space-between tsr-mt-10 arads-checkbox-container" style="flex-wrap: wrap; justify-content: space-between; gap: 15px; column-gap: 15px; ">
	
		<?php if ($all_aplication["num_rows"] != 0) { ?>

		<section class="tsr tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center tsr-p-5px tsr-border-solid-bottom tsr-border-solid-top tsr-border-bottom-2px fs-80 arads-serwer">
			<section class="col-fl-checkbox"> 
				<label class="checkboxs">
					<input type="checkbox" class="arads-pcheckbox">
					<span class="checkbox arads-pcheckbox"></span>
				</label>
			</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/replace.png" loading="lazy" title="Zamień Wyświetlane Dane" class="arads-serwer-change-data arads-serwer-change-data-p cursor-pointer" /></section>

			<?php 
				if (($all_aplication[$i]["dyrektor"] === $_SESSION["nick"]) || ($_SESSION["ranga"] === "właśćiciel") || ($_SESSION["flaga"] >= 30 && $_SESSION["flaga"] <= 35) ) {
			?>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/technical-service.png" loading="lazy" title="Zarządzaj Serwerem" class="cursor-pointer" /></section>
			<?php
				}
			?>

			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/info.png" loading="lazy" title="Wszystkie Informacje" class="cursor-pointer" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/signal-status.png" loading="lazy" title="Status Serwera" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/data-center.png" loading="lazy" title="Serwerownia" /></section>			
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/teamwork.png" loading="lazy" title="Zespół" /></section>
			<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/top.png" loading="lazy" title="Pełna Nazwa" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/hard-drive.png" loading="lazy" title="pojemność dysku" /></section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/customer-service.png" loading="lazy" title="Typ Serwera" /></section>
			
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="identyfikator">identyfikator</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv4">ipv4</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv6">ipv6</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="notatka">notatka</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="opis">opis</section>
		</section>
	
		<?php  
		
			}

			for	($i = 0; $i < $all_aplication["num_rows"]; $i++) {
			
				$ipv4 = json_decode($all_aplication[$i]["ipv4"], true);
				$ipv4_count = 0;
				if(!is_array($ipv4)){
					$ipv4 = ["brak"];
				}else{
					$ipv4_count = count($ipv4);
				}
				
				$ipv6 = json_decode($all_aplication[$i]["ipv6"], true);
				$ipv6_count = 0;
				if(!is_array($ipv6)){
					$ipv6 = ["brak"];
				}else{
					$ipv6_count = count($ipv6);
				}
				
				$config = json_decode($all_aplication[$i]["config"], true);
				$config_count = 0;
				if(!is_array($config)){
					$config = ["brak"];
				}else{
					$config_count = count($config);
				}
				
				// formatowanie odpowiednio kolorów
				if ($all_aplication[$i]["status"] == "online") {
					$bac = "background-green";
				}elseif (($all_aplication[$i]["status"] == "atak") OR ($all_aplication[$i]["status"] == "problem")) {
					$bac = "background-orange";
				}else{
					$bac = "background-red";
				} 
			
		?>

		<section class="tsr tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center tsr-p-5px tsr-border-solid-top fs-80 arads-serwer">
			<section class="col-fl-checkbox"> 
				<label class="checkboxs">
					<input type="checkbox" class="arads-checkbox" arads-data="<?php echo $all_aplication[$i]["id"]; ?>">
					<span class="checkbox arads-checkbox"></span>
				</label>
			</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/replace.png" loading="lazy" title="Zamień Wyświetlane Dane" class="arads-serwer-change-data cursor-pointer" /></section>

			<?php 
				if (($all_aplication[$i]["dyrektor"] === $_SESSION["nick"]) || ($_SESSION["ranga"] === "właśćiciel") || ($_SESSION["flaga"] >= 30 && $_SESSION["flaga"] <= 35) ) {
			?>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"> <a href="server?s=<?php echo $all_aplication[$i]["id"]; ?>" > <img src="pliki/ikony/edit/technical-service.png" loading="lazy" title="Zarządzaj Serwerem" class="cursor-pointer" /> </a> </section>
			<?php
				}
			?>
			
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px">
				<span class="tsr-pmodal">
					<img src="pliki/ikony/edit/info.png" loading="lazy" title="Wszystkie Informacje" class="cursor-pointer" />
					<section class="tsr-modal" tsr-modal-close="true">
						<section class="tsr">
							<span class="fs-110">Wszystkie Szczegóły</span>
							
							<div class="tsr tsr-mt-20">
								<?php if($all_aplication[$i]["ipv4"] != "null"){ 
									for($x = 0; $x < $ipv4_count; $x++){
								?>									
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">ipv4:</span>
									<span><?php echo $ipv4[$x]; ?></span>
								</div>
								<?php
									}
									}else{ ?>
									<section class="tsr-alert tsr-alert-error"><?php echo $error["ip"]["v4"]["not_found"] ?></section>
								<?php }?>
								<?php if($all_aplication[$i]["ipv6"] != "null"){ 
									for($x = 0; $x < $ipv6_count; $x++){
								?>										
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">ipv6:</span>
									<span><?php echo $ipv6[$x]; ?></span>
								</div>
								<?php
									}
									}else{ ?>
								<section class="tsr-alert tsr-alert-error"><?php echo $error["ip"]["v6"]["not_found"] ?></section>
								<?php }?>

								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Pojemność Dyskowa Serwera:</span>
									<span><?php echo $all_aplication[$i]["dysk"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Nazwa:</span>
									<span><?php echo $all_aplication[$i]["nazwa"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Data Center:</span>
									<span><?php echo $all_aplication[$i]["cd"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Zespół:</span>
									<span><?php echo $all_aplication[$i]["zespol"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Identyfikator Serwera:</span>
									<span><?php echo $all_aplication[$i]["identyfikator"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Czas Dodania Serwera:</span>
									<span><?php echo $all_aplication[$i]["datetime"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Notatka Do Serwera:</span>
									<span><?php echo $all_aplication[$i]["notatka"]; ?></span>
								</div>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Opis:</span>
									<span><?php echo $all_aplication[$i]["opis"]; ?></span>
								</div>
								
								<?php if($all_aplication[$i]["config"] != "null"){
								?>
								<div class="tsr tsr-algin-left">
									<span class="tsr-mr-20 fs-80">Konfiguracja Serwera:</span>								
								<?php
									$cfg = array_keys($config);
									$cfg_count = count($cfg);
								
									for($x = 0; $x < $cfg_count; $x++){
								?>									
									<span><?php echo $cfg[$x] .": ". $config[$cfg[$x]] . "<br  />"; ?></span>
								<?php
									}
									?>
								</div>									
									<?php
									}else{ ?>
									<section class="tsr-alert tsr-alert-error"><?php echo $error["sql_not_found"] ?></section>
								<?php }?>								
								
							</div>
							
						</section>
					</section>
				</span> 			
			</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px arads-serwer-data"> 
				<div class="tsr fs-90 <?php echo $bac; ?> tsr-mt-5 tsr-mb-5 tsr-p-5px">
					<span class="white"><?php echo $all_aplication[$i]["status"]; ?></span>
				</div>
			</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"> <?php echo $all_aplication[$i]["cd"]; ?> </section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"> <?php echo $all_aplication[$i]["zespol"]; ?> </section>
			<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px arads-serwer-data"> <?php echo $all_aplication[$i]["nazwa"]; ?> </section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px arads-serwer-data"> <?php echo $all_aplication[$i]["dysk"]; ?> </section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"> <?php echo $all_aplication[$i]["typ"]; ?> </section>
			
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="identyfikator"> <?php echo $all_aplication[$i]["identyfikator"]; ?> </section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv4"> <?php echo $ipv4[0]; ?> </section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv6"> <?php echo $ipv6[0]; ?> </section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="notatka"> <?php echo $all_aplication[$i]["notatka"]; ?> </section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="opis"> <?php echo $all_aplication[$i]["opis"]; ?> </section>
		</section>

			<?php 

			}
			if ($all_aplication["num_rows"] != 0) { ?>
		
		<section class="tsr tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center tsr-p-5px tsr-border-solid-bottom tsr-border-solid-top tsr-border-top-2px fs-80 arads-serwer">
			<section class="col-fl-checkbox"> 
				<label class="checkboxs">
					<input type="checkbox" class="arads-pcheckbox">
					<span class="checkbox arads-pcheckbox"></span>
				</label>
			</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/replace.png" loading="lazy" title="Zamień Wyświetlane Dane" class="arads-serwer-change-data arads-serwer-change-data-p cursor-pointer" /></section>

			<?php 
				if (($all_aplication[$i]["dyrektor"] === $_SESSION["nick"]) || ($_SESSION["ranga"] === "właśćiciel") || ($_SESSION["flaga"] >= 30 && $_SESSION["flaga"] <= 35) ) {
			?>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/technical-service.png" loading="lazy" title="Zarządzaj Serwerem" class="cursor-pointer" /></section>
			<?php
				}
			?>

			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-5-static tsr-p-5px"><img src="pliki/ikony/edit/info.png" loading="lazy" title="Wszystkie Informacje" class="cursor-pointer" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/signal-status.png" loading="lazy" title="Status Serwera" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/data-center.png" loading="lazy" title="Serwerownia" /></section>			
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/teamwork.png" loading="lazy" title="Zespół" /></section>
			<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/top.png" loading="lazy" title="Pełna Nazwa" /></section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/hard-drive.png" loading="lazy" title="pojemność dysku" /></section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px arads-serwer-data"><img src="pliki/ikony/edit/customer-service.png" loading="lazy" title="Typ Serwera" /></section>
			
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px tsr-display-none arads-serwer-data" title="identyfikator">identyfikator</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv4">ipv4</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-10-static tsr-p-5px tsr-display-none arads-serwer-data" title="ipv6">ipv6</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="notatka">notatka</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-20-5 col-fl-30-static tsr-p-5px tsr-display-none arads-serwer-data" title="opis">opis</section>
		</section>

		<?php 
		
			}else{
			
		?>
			<section class="tsr-alert tsr-alert-error"><?php echo $error["sql_not_found"] ?></section>
		<?php } ?>
		
	</section>
	<!--<button id="enable">Enable notifications</button>
	<button>Notify me!</button>-->
	<script>
		tsr_checkboxall2(".arads-checkbox-container", ".arads-pcheckbox", ".arads-checkbox");
		
		
		var img = '/to-do-notifications/img/icon-128.png';
var text = 'HEY! Your task "gfnfg" is now overdue.';
var notification = new Notification('To do list', { body: text, icon: img });
		
		function askNotificationPermission() {
  // function to actually ask the permissions
  function handlePermission(permission) {
    // set the button to shown or hidden, depending on what the user answers
    if(Notification.permission === 'denied' || Notification.permission === 'default') {
      notificationBtn.style.display = 'block';
    } else {
      notificationBtn.style.display = 'none';
    }
  }

  // Let's check if the browser supports notifications
  if (!('Notification' in window)) {
    console.log("This browser does not support notifications.");
  } else {
    if(checkNotificationPromise()) {
      Notification.requestPermission()
      .then((permission) => {
        handlePermission(permission);
      })
    } else {
      Notification.requestPermission(function(permission) {
        handlePermission(permission);
      });
    }
  }
}
		
		window.addEventListener('load', function () {
  var button = document.getElementsByTagName('button')[0];

  button.addEventListener('click', function () {
    // If the user agreed to get notified
    // Let's try to send ten notifications
    if (window.Notification && Notification.permission === "granted") {
      var i = 0;
      // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
      var interval = window.setInterval(function () {
        // Thanks to the tag, we should only see the "Hi! 9" notification
        var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
        if (i++ == 9) {
          window.clearInterval(interval);
        }
      }, 200);
    }

    // If the user hasn't told if they want to be notified or not
    // Note: because of Chrome, we are not sure the permission property
    // is set, therefore it's unsafe to check for the "default" value.
    else if (window.Notification && Notification.permission !== "denied") {
      Notification.requestPermission(function (status) {
        // If the user said okay
        if (status === "granted") {
          var i = 0;
          // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
          var interval = window.setInterval(function () {
            // Thanks to the tag, we should only see the "Hi! 9" notification
            var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
            if (i++ == 9) {
              window.clearInterval(interval);
            }
          }, 200);
        }

        // Otherwise, we can fallback to a regular modal alert
        else {
          alert("Hi!");
        }
      });
    }

    // If the user refuses to get notified
    else {
      // We can fallback to a regular modal alert
      alert("Hi!");
    }
  });
});


(async () => {
    // create and show the notification
    const showNotification = () => {
        // create a new notification
        const notification = new Notification('JavaScript Notification API', {
            body: 'This is a JavaScript Notification API demo',
            icon: './img/js.png'
        });

        // close the notification after 10 seconds
        setTimeout(() => {
            notification.close();
        }, 10 * 1000);

        // navigate to a URL when clicked
        notification.addEventListener('click', () => {

            window.open('https://www.javascripttutorial.net/web-apis/javascript-notification/', '_blank');
        });
    }

    // create and show the notification
    const showNotification2 = () => {
        // create a new notification
        const notification = new Notification('arads', {
            body: 'arads - panel',
            icon: './img/js.png'
        });

        // close the notification after 10 seconds
        setTimeout(() => {
            notification.close();
        }, 10 * 1000);

        // navigate to a URL when clicked
        notification.addEventListener('click', () => {

            window.open('https://www.javascripttutorial.net/web-apis/javascript-notification/', '_blank');
        });
    }

    // show an error message
    const showError = () => {
        const error = document.querySelector('.error');
        error.style.display = 'block';
        error.textContent = 'You blocked the notifications';
    }

    // check notification permission
    let granted = false;

    if (Notification.permission === 'granted') {
        granted = true;
    } else if (Notification.permission !== 'denied') {
        let permission = await Notification.requestPermission();
        granted = permission === 'granted' ? true : false;
    }

    // show notification or error
    granted ? showNotification() : showError();
	granted ? showNotification2() : showError();

})();
	</script>