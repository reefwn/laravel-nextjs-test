# Senior Full Stack Developer Test - FazWaz

Thank you for taking the time to do our full stack technical test for [FazWaz](https://www.fazwaz.com). It consists of two parts:
- [A coding test](#coding-test)
- [A few technical questions](#technical-questions)

We request you fork this repo and place the latest version of [Laravel](https://laravel.com/docs/9.x) inside the `html` folder provided. This test is about accessing your critical thinking and technical ability, so a full git log showing work done is important. 

***Any submissions without a git log or large commits will be rejected.***

## Coding Test
You will use the `properties.json` provided in this repo to get property information. 

Develop a frontend and backend application that consumes the provided JSON feed. Implement basic sorting, searching and pagination.

### Task requirements

We value your time and understand busy schedules. Focus on delivering a solution that meets the requirements efficiently. A 3-hour timeframe is a good target for most candidates.

We also take into consideration the `Answers.to.technical.questions.md` file and what you would like to have added if you had more time. Think of this as a complete solution. Clearly documenting your approach and desired features is just as valuable as coding them, as it demonstrates your communication and planning skills.

**Please thoroughly review the requirements and User Story below to ensure successful completion of this test.**

- Your code should be deployable via Laravel Sail (aka Docker).
- You **must** include PHP Unit tests.
- Forked repo with full Git log of your process.
- Frontend design is not a focus and won't be judged.
- Store the JSON data in a well-structured database with appropriate indexes.
- Provide a detailed `README.md` explaining how to deploy and run the application.

### User Story

<ins>Given</ins> I am a user visiting your application, </br>
<ins>When</ins> I load the index page, </br>
<ins>Then</ins> I should see a list of 25 properties that are for sale and unsold.</br>
<ins>And</ins>, I should be able to:

- Search for properties based on title and location (combined or individually).
- Sort properties by various criteria (price, date listed, etc.).
- Navigate through paginated results easily.

### Acceptance Criteria #1

- Frontend built with Vue.js or React.
- Display all relevant property information from the `properties.json` file.
- Implement pagination with clear links to navigate through results (25 properties per page).
- Include a search box for filtering properties by title and location (consider using string matching and location matching algorithms).
- Allow sorting of properties by price (ascending/descending) and date listed (newest first/oldest first).
- Implement dynamic routing that displays properties based on selected provinces (e.g., /bangkok/). Handle non-existent provinces with a 404 error page.

### Acceptance Criteria #2

Extensive unit tests utilizing PHP Unit to cover the following functionalities:

- `/api/properties` endpoint functionality to retrieve a list of properties.
- Pagination logic, ensuring only 25 properties are returned per request.
- Search functionality with unit tests covering filtering by title, location, and combined search criteria.
- Sorting functionality with unit tests verifying sorting by price and date listed.
- Error handling for invalid search queries, missing data, and unexpected database errors.

## Technical Questions

The following questions **must** be in a markdown file called `Answers.to technical.questions.md` that's commited to your forked repo.

- How long did you spend on the coding test? What additional features would you consider implementing if you had more time?
- Describe a security best practice you would implement in this application to protect the API.
- Explain how you would approach optimizing the performance of the API for handling large amounts of property data.
- How would you track down a performance issue in production? Have you ever had to do this? If so, please describe the experience.
