@api
Feature: Demo of Behat for our Drupal core build
  In order to test our Drupal core build with Behat
  As a developer
  I can use steps implemented by DrupalExtension and by a module's custom
  subcontext

  # Testing steps provided by DrupalExtension
  Scenario: User with editor role sees the toolbar "Add Block" link
    Given I am logged in as a user with the "editor" role
    When I visit "/"
    Then I should see "Add Block"

# Testing steps provided by Tiles as a subcontext
  Scenario: The homepage of the core build has "6" RTE tiles.
    When I visit "/"
    Then There are 5 RTE titles
    And There is a tile with title "Text Block 1"
