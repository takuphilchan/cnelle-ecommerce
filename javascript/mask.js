function viewPassword(){
    var passwordInput = document.getElementById('password-field');
    var passStatus = document.getElementById('pass-status');
    if (passwordInput.type == 'password')
    {
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash';
    }
    else
    {
      passwordInput.type='password';
      passStatus.className='fa fa-eye';
    }
  }

  function viewPassword2(){
    var passwordInput = document.getElementById('password-field-2');
    var passStatus = document.getElementById('pass-status-2');
    if (passwordInput.type == 'password')
    {
      passwordInput.type='text';
      passStatus.className='fa fa-eye-slash';
    }
    else
    {
      passwordInput.type='password';
      passStatus.className='fa fa-eye';
    }
  }