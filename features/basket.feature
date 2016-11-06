Feature:

  Scenario:
    Given a product with sku "RS1" and a cost of £5 was added to the catalogue
    When I add "RS1" to my basket
    Then the total basket cost should be £9

  Scenario:
    Given a product with sku "RS2" and a cost of £15 was added to the catalogue
    When I add "RS2" to my basket
    Then the total basket cost should be £20

  Scenario:
    Given a product with sku "RS3" and a cost of £10 was added to the catalogue
    When I add "RS3" to my basket
    Then the total basket cost should be £15

  Scenario:
    Given a product with sku "RS4" and a cost of £9 was added to the catalogue
    When I add "RS4" to my basket
    Then the total basket cost should be £13.8
