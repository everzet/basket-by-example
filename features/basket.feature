Feature:

  Scenario:
    Given there is a catalogue item:
      | sku  | RS1 |
      | cost | £5  |
    When I go to "/catalogue"
    And I click ".product:contains('RS1')"
    Then I should be on "/catalogue/RS1/add-to-basket"
    And I should see "Total cost: £9"

  Scenario:
    Given there is a catalogue item:
      | sku  | RS2 |
      | cost | £15 |
    When I go to "/catalogue"
    And I click ".product:contains('RS2')"
    Then I should be on "/catalogue/RS2/add-to-basket"
    And I should see "Total cost: £20"

  Scenario:
    Given there is a catalogue item:
      | sku  | RS3 |
      | cost | £10 |
    When I go to "/catalogue"
    And I click ".product:contains('RS3')"
    Then I should be on "/catalogue/RS3/add-to-basket"
    And I should see "Total cost: £15"

  Scenario:
    Given there is a catalogue item:
      | sku  | RS4 |
      | cost | £9  |
    When I go to "/catalogue"
    And I click ".product:contains('RS4')"
    Then I should be on "/catalogue/RS4/add-to-basket"
    And I should see "Total cost: £13.8"
