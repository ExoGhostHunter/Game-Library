document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.game-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var details = document.getElementById('details-' + id);
            if (details.style.display === 'none') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.launch-game').forEach(function(button) {
        button.addEventListener('click', function() {
            var steamid = this.getAttribute('data-steamid');
            window.location.href = 'steam://rungameid/' + steamid;
        });
    });

    document.querySelectorAll('.launch-game').forEach(function(button) {
        button.addEventListener('click', function() {
            var steamid = this.getAttribute('data-steamid');
            window.location.href = 'steam://rungameid/' + steamid;
        });
    });


    document.querySelectorAll('.edit-game').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('form');
            var id = form.getAttribute('data-id');
            var formData = new FormData(form);

            fetch('GameManager.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text()).then(data => {
                alert('Game updated successfully');
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    });

    document.querySelectorAll('.remove-game').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('form');
            var id = form.getAttribute('data-id');

            if (confirm('Are you sure you want to remove this game?')) {
                fetch('GameManager.php', {
                    method: 'POST',
                    body: JSON.stringify({ id: id }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.text()).then(data => {
                    alert('Game removed successfully');
                    form.parentElement.remove();
                }).catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});
