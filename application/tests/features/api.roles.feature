@roles
Feature: Testing the Roles API
    Scenario: Create a new role
        Given that I want to make a new "Role"
        And that the request "Authorization" header is "Bearer testadminuser"
        And that the request "data" is:
            """
            {
                "name":"manager",
                "display_name":"Manager"
            }
            """
        When I request "/roles"
        Then the response is JSON
        And the response has a "id" property
        And the type of the "id" property is "numeric"
        Then the guzzle status code should be 200

    Scenario: Create a new role with permissions
        Given that I want to make a new "Role"
        And that the request "Authorization" header is "Bearer testadminuser"
        And that the request "data" is:
            """
            {
                "name":"supervisor",
                "display_name":"Supervisor",
                "permissions":["Manage Users"]
            }
            """
        When I request "/roles"
        Then the response is JSON
        And the response has a "id" property
        And the type of the "id" property is "numeric"
        And the response has a "permissions" property
        And the "permissions.0" property equals "Manage Users"
        Then the guzzle status code should be 200

    Scenario: Assign a permission to a role
        Given that I want to update a "Role"
        And that the request "Authorization" header is "Bearer testadminuser"
        And that the request "data" is:
            """
            {
                "permissions":["Manage Users", "Manage Settings"]
            }
            """
        And that its "id" is "4"
        When I request "/roles"
        And the response has a "permissions" property
        And the "permissions.0" property equals "Manage Users"
        And the "permissions.1" property equals "Manage Settings"
        Then the guzzle status code should be 200

     Scenario: Change permission of a role
        Given that I want to update a "Role"
        And that the request "Authorization" header is "Bearer testadminuser"
        And that the request "data" is:
            """
            {
                "permissions":["Manage Posts"]
            }
            """
        And that its "id" is "4"
        When I request "/roles"
        And the response has a "permissions" property
        And the "permissions.0" property equals "Manage Posts"
        Then the guzzle status code should be 200

     Scenario: Removing permissions from a role
        Given that I want to update a "Role"
        And that the request "Authorization" header is "Bearer testadminuser"
        And that the request "data" is:
            """
            {
                "permissions":[]
            }
            """
        And that its "id" is "4"
        When I request "/roles"
        And the response has a "permissions" property
        And the "permissions" property is empty
        Then the guzzle status code should be 200

