package com.kelompok.e_majer;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.e_majer.api.ApiClient;
import com.kelompok.e_majer.api.ApiInterface;
import com.kelompok.e_majer.model.login.Login;
import com.kelompok.e_majer.model.login.LoginData;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener {

    EditText editTextEmail, editTextPassword;
    Button btnSignIn;
    String Email, Password;
    TextView tvRegister;
    ApiInterface apiInterface;
    SessionManager sessionManager;

    String message;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        editTextEmail = findViewById(R.id.editTextEmail);
        editTextPassword = findViewById(R.id.editTextPassword);

        btnSignIn = findViewById(R.id.btnsignin);
        btnSignIn.setOnClickListener(this);

        tvRegister = findViewById(R.id.tvRegister);
        tvRegister.setOnClickListener(this);
    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnsignin:
                Email = editTextEmail.getText().toString();
                Password = editTextPassword.getText().toString();
                login(Email, Password);
                break;
            case R.id.tvRegister:
                Intent intent = new Intent(this,RegisterActivity.class);
                startActivity(intent);
                break;
        }
    }

    public void login(String email, String password) {
        apiInterface = ApiClient.getClient().create(ApiInterface.class);
        Call<Login> loginCall = apiInterface.loginResponse(email, password);
        loginCall.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {
                if (response.body() != null && response.isSuccessful() && response.body().isStatus()) {

                    //untuk menyimpan sesi
                    sessionManager = new SessionManager(LoginActivity.this);
                    LoginData loginData = response.body().getLoginData();
                    sessionManager.createLoginSession(loginData);

                    //untuk pindah
                    Toast.makeText(LoginActivity.this, response.body().getLoginData().getName(), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                    message = "Login was successfull";
                } else {
                    Toast.makeText(LoginActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    message = "Invalid login";
                }

            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {
                Toast.makeText(LoginActivity.this, t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
                message = "Invalid login";
            }
        });
    }

}