document.addEventListener("DOMContentLoaded", function () {
    const text = "Library Attendance Monitoring System Cagayan State University Aparri";
    const colors = ["#A50002"];
    const typingText = document.getElementById('typingText');
    let index = 0;
    let forward = true;

    function type() {
        if (forward) {
            if (index < text.length) {
                const span = document.createElement('span');
                span.textContent = text.charAt(index);
                span.style.color = colors[index % colors.length]; // Cycle through colors
                typingText.appendChild(span);
                index++;
                setTimeout(type, 100); // Adjust typing speed here
            } else {
                setTimeout(() => {
                    forward = false;
                    type();
                }, 2000); // Delay before starting to erase
            }
        } else {
            if (index > 0) {
                typingText.removeChild(typingText.lastChild);
                index--;
                setTimeout(type, 100); // Adjust erasing speed here
            } else {
                setTimeout(() => {
                    forward = true;
                    type();
                }, 1000); // Delay before restarting the typing effect
            }
        }
    }

    type(); // Start the typing effect
});
