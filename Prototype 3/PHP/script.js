
function fetchWeather(city) {
 
    var cachedData = localStorage.getItem(city);
    if (cachedData) {
        display(JSON.parse(cachedData));
    } else {

        var url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=" + city + "&appid=d041a046b7cfd16f7fc37862f5767b2b";
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                saveToLocalStorage(city, data);

                display(data);
            })
            .catch(error => {
                console.error('Error fetching weather data:', error);
                alert('Error fetching weather data. Please try again.');
            });
    }
}


function saveToLocalStorage(key, data) {
    try {
        localStorage.setItem(key, JSON.stringify(data));
    } catch (e) {
        console.error('Error saving to localStorage:', e);
    }
}


function display(data) {
    var cityElement = document.getElementById('city');
    var tempElement = document.getElementById('temp');
    var weatherTypeElement = document.getElementById('weatherType');

    if (cityElement && tempElement && weatherTypeElement) {
        cityElement.textContent = data.name;
        tempElement.textContent = data.main.temp + "°C";
        weatherTypeElement.textContent = data.weather[0].description;
    } else {
        console.error('Error: One or more elements are null');
    }
}


function handleSubmit(event) {
    event.preventDefault();
    var cityInput = document.getElementById('city1');
    var city = cityInput.value.trim();
    if (city) {
        fetchWeather(city);
    } else {
        alert('Please enter a city name.');
    }
}


document.getElementById('searchForm').addEventListener('submit', handleSubmit);
