document.addEventListener("DOMContentLoaded", function() {
    //const links = document.querySelectorAll('a');
    const themeToggleBtn = document.getElementById('theme-toggle');

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }

    themeToggleBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });

    //links.forEach(link => {
    //    link.addEventListener('mouseover', function() {
    //        //this.style.color = '#47a447';
	//		//this.style.color = '#e74c3c;';
    //    });

    //   link.addEventListener('mouseout', function() {
    //        //this.style.color = '#e74c3c;';
	//		//this.style.color = 'red';
    //   });
    //});
});

