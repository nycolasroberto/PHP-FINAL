// Formatação de CPF
document.addEventListener('DOMContentLoaded', function() {
    const cpfInputs = document.querySelectorAll('input[name="cpf"]');
    
    cpfInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            e.target.value = value;
        });
    });

    // Validação de senha no cadastro
    const registerForm = document.querySelector('form[action*="register"]');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('As senhas não coincidem!');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 6 caracteres!');
                return false;
            }
        });
    }

    // Auto-hide de alertas
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Smooth scroll para links internos
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Contador de caracteres para textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(function(textarea) {
        const maxLength = textarea.getAttribute('maxlength');
        if (maxLength) {
            const counter = document.createElement('div');
            counter.className = 'char-counter';
            counter.style.textAlign = 'right';
            counter.style.fontSize = '0.8rem';
            counter.style.color = '#666';
            counter.style.marginTop = '0.5rem';
            
            function updateCounter() {
                const remaining = maxLength - textarea.value.length;
                counter.textContent = `${textarea.value.length}/${maxLength} caracteres`;
                counter.style.color = remaining < 50 ? '#dc3545' : '#666';
            }
            
            textarea.addEventListener('input', updateCounter);
            textarea.parentNode.appendChild(counter);
            updateCounter();
        }
    });

    // Confirmação antes de deletar
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja deletar este item?')) {
                e.preventDefault();
            }
        });
    });
});