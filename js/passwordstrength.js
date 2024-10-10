//  Strength passwords
function checkPasswordStrength(){
    const password = document.getElementById('password'), strength = document.getElementById('strength');
    password.addEventListener('input', () => {
        const score = [/.{5}/, /[A-Z]/, /[0-9]/, /[\W]/].reduce((a, t) => a + t.test(password.value), 0);
        strength.textContent = ['Weak','Fair', 'Good', 'Strong'][score - 1] || 'Very Weak';
        var curStrength = document.getElementById('strength');
        var strIndex = document.getElementById('strIndex');
        switch (curStrength.innerHTML) {
            case 'Weak':
                curStrength.style.backgroundColor = "orange";
                strIndex.value = 1;
            break;
            case 'Fair':
                curStrength.style.backgroundColor = "yellow";
                strIndex.value = 2;
            break;
            case 'Good':
                curStrength.style.backgroundColor = "blue";
                strIndex.value = 3;
            break;
            case 'Strong':
                curStrength.style.backgroundColor = "green";
                strIndex.value = 4;
            break;
            default:
                curStrength.style.backgroundColor = "red";
                strIndex.value = 0;
            break;
        }
    });
}

checkPasswordStrength();