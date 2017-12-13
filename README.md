# com.rickbanghart.civicustomrel
CiviCRM Extension to permit registering Owner and Pet for training class

Registration for the Event should accept Owner information and Pet information. 

When form is submitted:

1. Create Contact (Individual) based on owner info
2. Create Contact (Individual->animal) based on pet information
3. Create Relationship between Owner and Pet
4. Create Participant record based on owner
5. Create Participant_add record based on pet
