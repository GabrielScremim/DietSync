script.js
const API_KEY = '2bb3582072cd42b0a91dda692e247fa8';

document.addEventListener('DOMContentLoaded', function() {
    const newsGrid = document.getElementById('news-grid');

    function displayLoading() {
        newsGrid.innerHTML = '<div class="loading">Loading...</div>';
    }

    function displayError(error) {
        newsGrid.innerHTML = `<div class="error">Error fetching news: ${error.message}</div>`;
    }

    function displayArticles(articles) {
        newsGrid.innerHTML = articles.map(article => `
            <div class="news-item">
                ${article.urlToImage ? `<img src="${article.urlToImage}" alt="${article.title}">` : ''}
                <h2>${article.title}</h2>
                <p>${article.description}</p>
                <a href="${article.url}" target="_blank" rel="noopener noreferrer">Read more</a>
            </div>
        `).join('');
    }

    async function fetchNews() {
        try {
            displayLoading();
            const response = await fetch(`https://newsapi.org/v2/everything?q=saúde OR fitness OR academia&language=pt&sortBy=relevancy&apiKey=${API_KEY}`);
            const data = await response.json();
            displayArticles(data.articles);
        } catch (err) {
            displayError(err);
        }
    }

    fetchNews();
});