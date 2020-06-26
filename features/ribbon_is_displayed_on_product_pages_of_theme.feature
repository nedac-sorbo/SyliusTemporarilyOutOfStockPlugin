@theme @temporarily_out_of_stock @javascript
Feature:
  As a customer
  I need to be able to see that a product is temporarily out of stock
  So that I don't have to try to order a product to find out

  Background:
    Given the store operates on a single channel in the "United States" named "Fruitorama"
    And the store has "nedac/bootstrap-theme" theme
    And channel "Fruitorama" uses "nedac/bootstrap-theme" theme
    And the store classifies its products as "Fruits"
    And the store has a product "Banana" with code "banana", created at "05-10-2019"
    And this product belongs to "Fruits"
    And this product's price is "$1.25"
    And this product is tracked by the inventory
    And there are 0 units of product "Banana" available in the inventory
    And the store has a product "Pineapple" with code "pineapple", created at "05-10-2019"
    And this product belongs to "Fruits"
    And this product's price is "$5.00"
    And this product is tracked by the inventory
    And there are 2 units of product "Pineapple" available in the inventory

  Scenario: Ribbon is displayed on product cards of products that are out of stock
    When I browse products from taxon "Fruits"
    Then I should see the ribbon with text "Temporarily out of stock" on the "Banana" product card on the index page

  Scenario: Ribbon is not displayed on product cards of products that are not out of stock
    When I browse products from taxon "Fruits"
    Then I should not see the ribbon with text "Temporarily out of stock" on the "Pineapple" product card on the index page

  Scenario: Ribbon is displayed on product show page of product that is out of stock
    When I view product "Banana"
    Then I should see the ribbon with text "Temporarily out of stock" on the product image
    And I should see the ribbon with text "Temporarily out of stock" on the "Banana" product card on the show page

  Scenario: Ribbon is not displayed on product show page of product that is not out of stock
    When I view product "Pineapple"
    Then I should not see the ribbon with text "Temporarily out of stock" on the product image
    And I should see the ribbon with text "Temporarily out of stock" on the "Banana" product card on the show page

