const expenseForm = document.getElementById('expenseForm');
const expenseList = document.getElementById('expenseList');

expenseForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const expense = {
        category: document.getElementById('category').value,
        description: document.getElementById('description').value,
        amount: document.getElementById('amount').value,
        date: document.getElementById('date').value,
    };

    fetch('server.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(expense),
    }).then(response => response.text())
      .then(data => {
          alert(data);
          loadExpenses();
      });
});

function loadExpenses() {
    fetch('server.php?action=list')
        .then(response => response.json())
        .then(expenses => {
            expenseList.innerHTML = '';
            expenses.forEach(expense => {
                expenseList.innerHTML += `
                    <div class="expense">
                        <h3>${expense.category}</h3>
                        <p>${expense.description}</p>
                        <p><strong>Amount:</strong> $${expense.amount}</p>
                        <p><strong>Date:</strong> ${expense.date}</p>
                    </div>
                `;
            });
        });
}

loadExpenses();
