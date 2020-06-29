@theme @javascript
Feature:
  As a customer
  I need to be able to see that a product is temporarily out of stock
  So that I don't have to try to order a product to find out

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

