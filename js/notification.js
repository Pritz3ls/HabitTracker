// Will use this for reminders after reworking the habits table
function reminder(){
    Notification.requestPermission().then(perm => {
        if(perm === "granted" && !isNaN(habitName)){
            new Notification("habere",{
                body: "You're "+habitName+" is about to start!",
                tag: "habere reminder"
            });
        }
    });
}
reminder();