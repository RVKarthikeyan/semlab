const symptomForm = document.getElementById('symptomForm');
const symptomsInput = document.getElementById('symptomsInput');
const recommendationList = document.getElementById('recommendationList');

symptomForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const symptoms = symptomsInput.value;

    fetch('server.php?action=addUserSymptoms', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ symptoms: symptoms })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetch('server.php?action=getMedicineRecommendations')
                .then(response => response.json())
                .then(medicines => {
                    let recommendations = '';
                    medicines.forEach(medicine => {
                        recommendations += `
                            <div class="medicine">
                                <h3>${medicine.name}</h3>
                                <p><strong>Description:</strong> ${medicine.description}</p>
                                <p><strong>Recommended For:</strong> ${medicine.recommended_for}</p>
                                <p><strong>Side Effects:</strong> ${medicine.side_effects}</p>
                            </div>
                        `;
                    });
                    recommendationList.innerHTML = recommendations;
                });
        } else {
            alert('Failed to add symptoms');
        }
    });
});
