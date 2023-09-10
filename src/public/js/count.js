const countElement = document.getElementById('quantity');
const text = document.getElementById('count');
let count = 1;

const incrementCount = () => {
    count++;
    countElement.value = count;
    text.textContent = count;
};

const decrementCount = () => {
    if (count > 1) {
        count--;
        countElement.value = count;
        text.textContent = count;
    }
};