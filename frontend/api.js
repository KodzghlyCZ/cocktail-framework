function fetchAPI(endpoint, dataProcessFunction, parameters) {
    // Make a fetch request
    fetch(config['apiBaseURL'] + endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify(parameters)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json()
        })
        .then(data => {
            dataProcessFunction(data);
        })
        .catch(error => {
            console.error('Fetch failed:', error.message);
        });
}