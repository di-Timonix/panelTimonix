	/* 
	
		Timonix Arads
		system zarządzania serwisami timonix.pl
		di_Timonix
		
		zarządzanie uprawieniami witryny
	
	*/
	
	setTimeout(function () {

		(async () => {
			// create and show the notification
			const showNotification = () => {
				// create a new notification
				const notification = new Notification('JavaScript Notification API', {
					body: 'This is a JavaScript Notification API demo',
					icon: '../pliki/logo/logo_bm_white_400_400.png'
				});

				// close the notification after 10 seconds
				setTimeout(() => {
					notification.close();
				}, 10 * 1000);

				// navigate to a URL when clicked
				notification.addEventListener('click', () => {

					window.open('https://www.arads.timonix.pl/web-apis/javascript-notification/', '_blank');
				});
			}

			/* // show an error message
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
			} */

			// show notification or error
			// granted ? showNotification() : showError();

		})();

	}, 4);
	
	window.addEventListener("load", () => {
		(async () => {
			let arads_test_upr = true,
				arads_test_upr_l = 0;
			
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
				
				if (granted == false) {
					arads_control_eng ();
				}
			}
			
			// check geolocalization posiotion
			// if (navigator.geolocation) {
				// let xd = navigator.geolocation.getCurrentPosition(function (t) {console.log(t)});
				// console.log(xd);
			// } else {
				// x.innerHTML = "Geolocation is not supported by this browser.";
			// }
			
			
			function handlePermission() {
				navigator.permissions.query({name:'geolocation'}).then(function(result) {
					if (result.state == 'granted') {
					  report(result.state);
					} else if (result.state == 'prompt') {
					  report(result.state);
					  //navigator.geolocation.getCurrentPosition(revealPosition,positionDenied,geoSettings);
					  navigator.geolocation.getCurrentPosition(function (t) {console.log({latitude: t.coords.latitude, longitude: t.coords.longitude})});
					} else if (result.state == 'denied') {
					  report(result.state);
					}
				result.onchange = function() {
				  report(result.state);
				}
			  });
			}

			function report(state) {
			  console.log('Permission ' + state);
			}

			handlePermission();
			
			
			function arads_control_eng () {
				console.error("ARADS: brak uprawnień - notification");
				//location.assign("https://www.timonix.pl");
			}
		})();
	});