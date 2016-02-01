@api
Feature: Demo of Behat for our Drupal core build
  In order to test our Drupal core build with Behat
  As a developer
  I can use steps implemented by DrupalExtension and by a module's custom
  subcontext

  # Testing steps provided by DrupalExtension
  Scenario: User with editor role sees the toolbar "Add Tile" link
    Given I am logged in as a user with the "editor" role
    When I visit "/"
    Then I should see "Add Tile"
