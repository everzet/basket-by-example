Feature:

  Scenario:
    Given a product with sku "RS1" and a cost of £5 was added to the catalogue
    When I go to "/catalogue"
    And I click ".product:contains('RS1')"
    Then I should be on "/catalogue/RS1/add-to-basket"
    And I should see "Total cost: £9"

  Scenario:
    Given a product with sku "RS2" and a cost of £15 was added to the catalogue
    When I go to "/catalogue"
    And I click ".product:contains('RS2')"
    Then I should be on "/catalogue/RS2/add-to-basket"
    And I should see "Total cost: £20"

  Scenario:
    Given a product with sku "RS3" and a cost of £10 was added to the catalogue
    When I go to "/catalogue"
    And I click ".product:contains('RS3')"
    Then I should be on "/catalogue/RS3/add-to-basket"
    And I should see "Total cost: £15"

  Scenario:
    Given a product with sku "RS4" and a cost of £9 was added to the catalogue
    When I go to "/catalogue"
    And I click ".product:contains('RS4')"
    Then I should be on "/catalogue/RS4/add-to-basket"
    And I should see "Total cost: £13.8"
