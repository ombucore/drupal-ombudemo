@api @editor
Feature: Manage basic pages
  In order to facilitate content creation
  As an Editor
  I need to be able to create, delete, publish, or unpublish pages from the admin menu item 'Core Content > Pages: Manage'

  Background:
    Given I am logged in as a user with the "editor" role

  Scenario: Add a page
    Given I am on "/node/add/page"
    When I fill in "Title" with "The page title"
    And I fill in "Body" with "Some random text of the right length"
    And I press the "Save" button
    Then I should see "The page title"
    And I should see "Some random text of the right length"
    And show last response
