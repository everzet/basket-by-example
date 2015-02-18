Feature: Applying VAT and a delivery costs to the basket
  In order to be more confident in making a purchase
  As a customer
  I need VAT and a cost of delivery to be calculated for my basket

  Scenario: Product costing less than £10 results in delivery cost of £3
    Given there is a product with SKU "RS1" and a cost of £5 in the catalogue
    When I go to "/catalogue"
    And I click "Add to basket" inside ".product:contains('RS1')"
    Then I should see "Total price of basket: £9"

  Scenario: Product costing more than £10 results in delivery cost of £2
    Given there is a product with SKU "RS2" and a cost of £15 in the catalogue
    When I go to "/catalogue"
    And I click "Add to basket" inside ".product:contains('RS2')"
    Then I should see "Total price of basket: £20"

  Scenario: Product costing exactly £10 results in delivery cost of £3
    Given there is a product with SKU "RS3" and a cost of £10 in the catalogue
    When I go to "/catalogue"
    And I click "Add to basket" inside ".product:contains('RS3')"
    Then I should see "Total price of basket: £15"

  Scenario: Product costing £10 with added VAT still results in delivery cost of £3
    Given there is a product with SKU "RS4" and a cost of £9 in the catalogue
    When I go to "/catalogue"
    And I click "Add to basket" inside ".product:contains('RS4')"
    Then I should see "Total price of basket: £13.8"
