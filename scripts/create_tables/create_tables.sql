SOURCE table_ingredients.sql;
SOURCE table_contain.sql;
SOURCE table_pizzas.sql;
SOURCE table_associate.sql;
SOURCE table_sizes.sql;
SOURCE table_orders.sql;
SOURCE table_clients.sql;
SOURCE table_deliver.sql;
SOURCE table_drivers.sql;
SOURCE table_vehicules.sql;
SOURCE table_drive.sql;

ALTER TABLE Orders ADD CONSTRAINT FK_Orders_id_client FOREIGN KEY (id_client) REFERENCES Clients(id);
ALTER TABLE Contain ADD CONSTRAINT FK_Contain_id_pizza FOREIGN KEY (id_pizza) REFERENCES Pizzas(id);
ALTER TABLE Contain ADD CONSTRAINT FK_Contain_id_ingredient FOREIGN KEY (id_ingredient) REFERENCES Ingredients(id);
ALTER TABLE Associate ADD CONSTRAINT FK_Associate_id_pizza FOREIGN KEY (id_pizza) REFERENCES Pizzas(id);
ALTER TABLE Associate ADD CONSTRAINT FK_Associate_id_order FOREIGN KEY (id_order) REFERENCES Orders(id);
ALTER TABLE Associate ADD CONSTRAINT FK_Associate_id_size FOREIGN KEY (id_size) REFERENCES Sizes(id);
ALTER TABLE Drive ADD CONSTRAINT FK_Drive_id_driver FOREIGN KEY (id_driver) REFERENCES Drivers(id);
ALTER TABLE Drive ADD CONSTRAINT FK_Drive_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES Vehicules(id);
ALTER TABLE Deliver ADD CONSTRAINT FK_Deliver_id_order FOREIGN KEY (id_order) REFERENCES Orders(id);
ALTER TABLE Deliver ADD CONSTRAINT FK_Deliver_id_driver FOREIGN KEY (id_driver) REFERENCES Drivers(id);
ALTER TABLE Deliver ADD CONSTRAINT FK_Deliver_id_vehicule FOREIGN KEY (id_vehicule) REFERENCES Vehicules(id);
