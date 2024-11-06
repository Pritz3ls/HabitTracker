// Handles update from the repitition type dropdown
// Update the page if the dropdown is change
function HandleCustomRepitition(){
    document.getElementById('repitition_type').addEventListener('change', function() {
        const selectValue = this.value;
        const customField = document.getElementById('custom_repitition_value');
        if(selectValue == 'custom'){
            customField.style.display = 'flex';
        }else{
            customField.style.display = 'none';
        }
    });
}
// Handles update from the weekly format
// Update the page if the dropdown is change
function HandleWeekDay(){
    document.getElementById('repitition_type').addEventListener('change', function() {
        const selectValue = this.value;
        const customField = document.getElementById('dayofweek');
        if(selectValue == 'weekly'){
            customField.style.display = 'flex';
        }else{
            customField.style.display = 'none';
        }
    });
}

HandleCustomRepitition();
HandleWeekDay();