Feature: Handle user login

  Background:
    Given there are Users with the following details:
      | id | username       | email                 | password       |
      | 1  | testUser | testUser@foo.com | testUser |


  Scenario: Handle a login via RESTful
    When i send a "POST" request to "/api/login" with:
      """
        {
          "username": "testUser",
          "password": "testUser"
        }
      """
    Then the response should be in JSON
    And the response should contain "token"

  Scenario: Handle a login via HTML
    When I am on "/login"
    When I fill in "username" with "testUser"
    When I fill in "password" with "testUser"
    When I press "Log in"
    Then the response status code should be 200