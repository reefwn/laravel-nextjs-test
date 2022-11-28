# FazWaz - Full Stack Developer Test
Thank you for taking the time to do our full stack technical test for FazWaz. It consists of two parts:
- [A coding test](#task)
- [A few technical questions](#tech)

We request you fork this repo and place the latest version of [Laravel](https://laravel.com/docs/9.x) inside the `html` folder provided. This test is about accessing your critical thinking and technical ability, so a full git log showing work done is important.

## Coding Test
You will use the `properties.json` provided in this repo to get property information. 

Develop a frontend and backend application that consumes the provided JSON feed. Implement basic category, searching and pagination.

## <a name="task">Task requirements</a>

Feel free to spend as much or as little time on the exercise as you like as long as the following requirements have been met. However, we understand people have busy lives and would guide you to spend no more than 3 hours on a submission. We also take into consideration the `Answers to technical questions.md` file and what you would like to have added if you had more time. You should look at this as the complete solution, it's much quicker to explain what you would like to have done than code it.

- Please complete the user story below.
- Your code should be deployable via Laravel Sail (aka Docker).
- You **must** include Unit tests.
- Forked repo with full Git log of your process.
- The design of the frontend is not important and is not judged in this test
- A database that stores the JSON file in a well-formed way, with appropriate indexes.
- A README to explain how to boot and run the end result.

## User Story
Given **I am a user running the application,** when **I load the index page** then **I want to see a list of 25 properties that are for sale and unsold**.

### Acceptance Criteria

- Frontend should be coded in Vue.js
- The properties should include all the relevant data provided in the `properties.json` file.
- There should be pagination links at the bottom to navigate further down the records.
- There should be a search box to query the database for properties based on title or location.
- Dynamic routing with **provinces** should result in a list of properties provided in `properties.json` file (eg. https://localhost/bangkok/) otherwise 404.

## <a name="tech">Technical Questions</a>
Please answer the following questions in a markdown file called `Answers to technical questions.md`.

- How long did you spend on the coding test? What would you add to your solution if you had more time? If you didn't spend much time on the coding test then use this as an opportunity to explain what you would add.
- What was the most useful feature that was added to the latest version of your chosen language? Please include a snippet of code that shows how you've used it.
- How would you track down a performance issue in production? Have you ever had to do this?
