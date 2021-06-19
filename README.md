## Reward System

This repositoy contains a simple reward system, developed for the coding challenge test at Kagati Incorporation. 

## Installation

Go to the project folder in command prompt.

Run composer install.

```bash
composer install
```

Change .env.example to .env and set the database configs.

For Windows

```
DB_DATABASE=reward_system
DB_USERNAME=root
DB_PASSWORD=
```

For MAC (MAMP)

```
DB_DATABASE=reward_system
DB_USERNAME=root
DB_PASSWORD=root
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock  //path to mysql socket
```

Do migration and seed.

Migrate:
```bash
php artisan migrate
```

Seed:
```bash
php artisan db:seed
```

Run:

```bash
php artisan serve
php artisan serve --port=8001  //for different port
```


## Details

The project consists of following features:
Currency, Customers, Orders, Rewards, Expired Logs. 

### Currency
Currently 3 currencies (USD, NPR and INR) with corresponding conversion factor to USD is seeded into database.


### Customers
Currently 3 customers with each of above mentioned currency is seeded into database. The customer list is displayed in customers section with their total sales, total reward earned and current credit points. 
<br>
Following features are allowd in customer section.
<ul>
    <li>User can view reward points earned by customers.</li>
    <li>User can view expired reward points of customers.</li>
</ul>

### Orders

This feature allows user to display the existing orders as well as add new orders by selecting customer and sales amount. 

<ul>
    <li>
        The orders with different dates, currencies and customers are seeded into database.
    </li>
    <li>
        Orders will have two status, "Pending" and "Completed". New orders will be marked as "Pending".
    </li>
    <li>
        User can Mark the order as "Completed" for the pending orders by pressing "Mark as completed" button beside each order.
    </li>
</ul>

### Rewards
Rewards are calculated once the "Mark as Completed" button is pressed. The completion of order and awarding of reward points is done in following steps:

<ul>
    <li>
        Reward points is calculated from sales amount using currency conversion factor obtained from currencies table. 
    </li>
    <li>
        Reward expiry date is evaluated by adding a year to current date. 
    </li>
    <li>
        New reward record in entered in rewards table.
    </li>
    <li>
        Status of order is marked as "Completed"
    </li>
    <li>
       Reward points are added to 'credit' field of customer.
    </li>
</ul>

### Expiry Logs

The expiry check of the rewards points are expected to be performed by running cron job once in a day or a once in a week depending upon the requirements. The action to be executed in cron job consists of following steps:

<ul>
    <li>
        Get all customers from customer table.
    </li>
    <li>
       For each customers repeat following the steps:
    </li>
    <li>
        Calculate amounts that are not expired by querying in rewards table with date comparison.
    </li>
     <li>
        Calculate expired amounts as a difference of current customers credit and unexpired amount calculated from above step.
    </li>
    <li>
        Update customers credit points by deducting expired amount from credit.
    </li>
    <li>
        Set status to "Expired" in records of rewards table by date comparison.
    </li>
    <li>
        A new record is entered into expired logs table.
    </li>
</ul>

Also, for testing purpose, there is a feature provided in customer section to trigger the expiry check action for the date "Jan 1, 2022".

## Screenshots


#### Customers Page:
![Test Image 1](https://github.com/sauravshrestha13/reward_system/blob/master/customers.png)

#### Orders Page:
![Test Image 2](https://github.com/sauravshrestha13/reward_system/blob/master/orders.png)

#### Rewards Page:
![Test Image 2](https://github.com/sauravshrestha13/reward_system/blob/master/rewards.png)

#### Expiry Log Page:
![Test Image 2](https://github.com/sauravshrestha13/reward_system/blob/master/expiry_log.png)
