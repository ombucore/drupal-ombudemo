@api
Feature: Editors can add or edit pages
  In order to add pages to this site
  As an editor
  I can add a new page and make a change to it

  Background:
    Given I am logged in as a user with the "editor" role

  Scenario: Editor can edit a page
    When I visit "node/add/page"
    Then I should get a "200" HTTP response

