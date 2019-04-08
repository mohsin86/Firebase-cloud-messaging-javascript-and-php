importScripts('https://www.gstatic.com/firebasejs/5.9.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.9.2/firebase-messaging.js');

var config = {
    apiKey: "AIzaSyAguvmB9WPHTgW7RRwbOvmA5G3r8WM15CI",
    authDomain: "deliveryman-messaging.firebaseapp.com",
    databaseURL: "https://deliveryman-messaging.firebaseio.com",
    projectId: "deliveryman-messaging",
    storageBucket: "deliveryman-messaging.appspot.com",
    messagingSenderId: "574046356700"
};
firebase.initializeApp(config);

var messaging2 = firebase.messaging();


messaging2.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    var notificationTitle = 'Background Message Title';
    var notificationOptions = {
        body: 'Background Message body.',
        // icon: '/theme.sebpo.net/firebase/firebase-logo.png'

        
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
