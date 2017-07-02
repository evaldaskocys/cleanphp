# Task: create new feature
Requirements:
- Assign Task to User
- Change task status to `Task::STATUS_TESTING`
- Allow to describe testing scenario (text field)
- Assignee should be notified by email

## Cheat-sheet
- Task Entity:
    - Define constant Task::STATUS_TESTING
    - Create field `testScenario`
    - `bin/console doctrine:generate:entities AppBundle:Task`
    - `bin/console d:s:u --dump-sql --force`
- Create form AssignTesterType
    - Field `assignee`
    - Field `testScenario`
- TaskController
    - `assignTesterAction()`
- Create and dispatch event `TaskTesterAssigned`
- Listen to event `TaskTesterAssigned` and send email notification to assignee

## Bonus
- Create CLI command `task:assign:tester <task_id> <tester_id>`
- Create `TaskService` method, reuse in Controller and Command
- Create API method
- Create custom validator for `testScenario` field validation
