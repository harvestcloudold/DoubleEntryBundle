Account Posting Example
=======================

This is an example to show who pays what in the Harvest Cloud system.  In this
example we are just showing the account postings at the time an Order is
dispatched by the Seller.  This is when all parties are invoiced.

For this example we will use the following Order information:

    Order subtotal:                $100
    Hub fee charged to Buyer:       $10
    Order total:                   $110
    Hub fee charged to Seller:       $8
    Posting fee charged to Seller:   $4 (4%)


Background
----------

We use standard T-accounts to plan our postings:

         Debits          Credits
    ---------------------------------
                    |
                    |
                    |


As a reminder, this is how different accounts are affected by debits and
credits:

    +---------------+------------+------------+
    |               |  Debits    |  Credits   |
    +---------------+------------+------------+
    |  Assets       |  Increase  |  Decrease  |
    |  Liabilities  |  Decrease  |  Increase  |
    |  Income       |  Decrease  |  Increase  |
    |  Expenses     |  Increase  |  Decrease  |
    +---------------+------------+------------+


Posting at Order Dispatch
-------------------------

The following are the postings that take place when an Order is dispatched by the Seller.


Seller invoices Buyer for total cost of Order:

          Seller A/R (Asset)                    Seller Sales (Income)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |     $110                  $110      |
                    |                                     |


Buyer is invoiced by Seller for total cost of Order:

         Buyer A/P (Liability)                Buyer Purchases (Expense)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |     $110                  $110      |
                    |                                     |


Exchange invoices Seller for the posting fee:

           Exchange A/R (Asset)                Exchange Sales (Income)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |       $4                   $4       |
                    |                                     |


Seller is invoiced by Exchange for the posting fee:

         Seller A/P (Liability)                  Seller COGS (Expense)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |       $4                   $4       |
                    |                                     |


Hub invoices Seller for the hub fee:

              Hub A/R (Asset)                     Hub Sales (Income)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |       $8                   $8       |
                    |                                     |


Seller is invoiced by Hub for the hub fee:

         Seller A/P (Liability)                  Seller COGS (Expense)
    ---------------------------------     ---------------------------------
         Debits          Credits               Debits          Credits
    ---------------------------------     ---------------------------------
                    |                                     |
                    |       $8                   $8       |
                    |                                     |
