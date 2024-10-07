// Handles update from the repitition type dropdown
// Update the page if the dropdown is change
function HandleCustomRepitition(){
    document.getElementById('repitition_type').addEventListener('change', function() {
        const selectValue = this.value;
        const customField = document.getElementById('custom_repitition_value');
        if(selectValue == 'custom'){
            customField.style.display = 'block';
        }else{
            customField.style.display = 'none';
        }
    });
}

HandleCustomRepitition();