<template>
  <section>
    <h3>Goal</h3>
    <p>To create a simple restricted area with 2 levels of access, using the given HTML files.</p>
  </section>
  <section>
    <h3>Requirements / details</h3>
    <ul>
      <li>
        There will be 2 types of users: the Administrator user and the Staff user. They will both access the protected area
        through a <router-link to="/login" target="_blank" >login form</router-link> page.
      </li>
      <li>
        The Administrator will manage Staff users and assign them "policies", which are like client accounts. Each policy belongs
        to one Staff user (or none). The Staff user will only see his assigned policies.
      </li>
      <li>
        <strong>Administrator</strong>:
        <ul>
          <li>
            Can see the  <router-link to="/all-staff" target="_blank">Staff list</router-link> page,
            which shows a list of all current Staff users.
          </li>
          <li>
            Needs to have the ability to create new Staff accounts, consisting in a name, an email
            (which is the username) and a password.
          </li>
          <li>
            Clicking on a row on the Staff list page will take the admin to the
            <router-link to="/edit-staff" target="_blank" >Staff details</router-link> page.
          </li>
          <li>
            The Staff detail page will show some basic details about the Staff and the list of policies assigned to him. From there
            the Administrator can add policy (from a list of existing unallocated ones) or remove existing ones (which will unlink the
            policy from that Staff user and will make it available for allocation).
          </li>
          <li>
            The "Remove Staff" option will remove the user (soft delete) and unlink all his policies.
          </li>
        </ul>
      </li>
      <li>
        <strong>Staff</strong>:
        <ul>
          <li>
            When logging in he will be taken to the
            <router-link to="/dashboard-staff" target="_blank" >Staff dashboard</router-link> page, which will display
            a list of his policies.
          </li>
          <li>
            Clicking on a row on the list of policies will the user to a simple page (nothing fancy) that will display the details
            of that policy (same information as the table, read only).
          </li>
        </ul>
      </li>
      <li>
        The file "policies.sql" contains a basic table for the policies (to be changed if required), that is assumed
        to contain data to be used as explained above (dummy data can be used for testing).
      </li>
      <li>
        Dependecies (if any) should be managed with Composer.
      </li>
    </ul>
  </section>
</template>

<script>

</script>
