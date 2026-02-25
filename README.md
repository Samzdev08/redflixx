# RedFlix

A Netflix-inspired web application that lets users search for movies and series, view details, and leave reviews — without streaming.

---

## Project Structure

```
src/
├── index.html
├── css/
├── js/
├── php/
└── logs/
```

---

## Features

### Frontend
- Search for any movie or series using the OMDB API
- Display movie posters, titles, synopsis, duration, genre, director, and ratings
- User comment/review section

### Backend
- Anti-spam system: users are limited to 3 messages per minute
- Profanity filter: blocks offensive, racist, or homophobic comments
- Error logging: a dedicated log page displays alerts and errors for developers
- API failure detection: a critical error is raised after 5 consecutive failed connection attempts to the API

---

## Tech Stack

| Layer    | Technologies          |
|----------|-----------------------|
| Frontend | HTML, CSS, JavaScript |
| Backend  | PHP, JSON             |
| API      | OMDB API              |
| Logging  | Monolog               |

---

## Architecture

```
Client (JS)  <-->  Server (PHP + JSON)  <-->  OMDB API
```

The client communicates with the PHP server, which fetches movie data from the OMDB API and returns it as JSON.

---

## Getting Started (localhost:8080)

### Requirements
- PHP 8.x installed on your machine — check with:
  ```bash
  php -v
  ```

### Run the project

1. Clone or download the repository
2. Navigate to the `src` folder:
   ```bash
   cd src
   ```
3. Start the PHP built-in server on port 8080:
   ```bash
   php -S localhost:8080
   ```
4. Open your browser and go to:
   ```
   http://localhost:8080
   ```

---

## Reliability

- **API outage**: after 5 failed attempts, a critical error is logged and displayed
- **Spam protection**: a cooldown timer prevents users from sending more than 3 messages per minute
- **Content moderation**: a keyword-based filter blocks inappropriate comments
- **Logs**: all errors and alerts are visible on a dedicated page

---

## Known Limitations

- Some log types are not yet fully implemented
- The profanity filter relies on a manually curated word list (no full dictionary yet)
- No fallback API in case the primary OMDB API goes down

---

## Future Improvements

- Add a backup API to ensure continuity during outages
- Implement a comprehensive banned-words dictionary
- Improve the overall logging and alerting system

---

## References

- [OMDB API](https://www.omdbapi.com/)
- [Monolog](https://github.com/Seldaek/monolog)
