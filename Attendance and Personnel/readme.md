Note: 90% complete. Attendance summary is the only functionality that is incomplete. Might need to add a new table
to keep track of the month-by-month data. 

New features since last update:
  PERSONNEL
    No changes, already fully functional w/ error checking.
  ATTENDANCE
    1. All date fields are now date pickers.
    2. Added the leave functionality. Upon submission, several error checking systems are in place to ensure the following:
        the start date and end date entered by the user are valid dates. That is, the start date does not coincide with the previous
        leave's end date. Server side script also ensures that the person is not still on leave. Also makes sure that the leave balance
        after application is valid. 
    3. For update and delete, staff will appear on the drop down only if they already have an existing record in the database. This is to
        ensure consistency and to prevent users from taking advantage of the system.
    4. Added a List of Staff Who Are Currently On Leave. This will check all records wherein the end date is further from today's date.
        Meaning, this list will automatically update upon loading. Staff whose end dates are not yet past today's date will be automatically
        removed.
    5. The table for attendance_counter has also been altered. Added 5 new columns: undertime, offset, leave_start, leave_end, leave_type 
    
ATTENDANCE SUMMARY NOTES
  Drop down to pick staff and year are working. The remaining balance for the sick leave and vacation leave will automatically
  update itself upon changing the staff and/or year. Edit field option has already been added. No functionality yet since I am
  contemplating adding a new table. 
  
  Known issues:
    1. Default value for staff_id and year are not set in the case that there is no _POST['staff_id'] and _POST['year'].
    The solution would be to set default values for staff_id and year. 
    
    2. Might need to add a new table to keep track of the month-by-month data. Need to discuss this with Allen. 
    
  Theoretically, once all the known issues have been resolved, the last thing to add is an edit form for the values of the summary.
  
  
