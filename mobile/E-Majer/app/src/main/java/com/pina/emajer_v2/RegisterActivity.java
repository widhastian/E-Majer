package com.pina.emajer_v2;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.pina.emajer_v2.API.RetrofitClient;
import com.pina.emajer_v2.API.ApiLoginRegister;
import com.pina.emajer_v2.Model.register.Register;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterActivity extends AppCompatActivity implements View.OnClickListener {

    EditText editTextEmail, editTextPassword, editTextName, editTextKelas, editTextUsername;
    Button btnRegister;
    TextView tvLogin;
    ImageButton btnBack;
    String Email, Password, Name, Kelas, Username;
    ApiLoginRegister apiInterface;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        editTextEmail = findViewById(R.id.editTextRegisterEmail);
        editTextPassword = findViewById(R.id.editTextRegisterPassword);
        editTextName = findViewById(R.id.editTextRegisterName);
        editTextKelas = findViewById(R.id.editTextRegisterKelas);
        editTextUsername = findViewById(R.id.editTextRegisterUsername);
        btnRegister = findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(this);

        tvLogin = findViewById(R.id.tvLoginHere);
        tvLogin.setOnClickListener(this);
    }

    @Override
    public void onClick(View view) {
        switch (view.getId()) {
            case R.id.btnRegister:
                Email = editTextEmail.getText().toString();
                Password = editTextPassword.getText().toString();
                Name = editTextName.getText().toString();
                Kelas = editTextKelas.getText().toString();
                Username = editTextUsername.getText().toString();
                register(Name, Email, Username, Password, Kelas);
                break;
            case R.id.tvLoginHere:
                Intent intent = new Intent(this, LoginActivity.class);
                startActivity(intent);
                finish();
                break;
        }

    }

    private void register(String name, String email, String username, String password, String kelas) {
        apiInterface = RetrofitClient.getClient1().create(ApiLoginRegister.class);
        Call<Register> registerCall = apiInterface.registerResponse(name, email, username, password, kelas);
        registerCall.enqueue(new Callback<Register>() {
            @Override
            public void onResponse(Call<Register> registerCall, Response<Register> response) {
                if (response.body() != null && response.isSuccessful() && response.body().isStatus()) {
                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                    startActivity(intent);
                    finish();
                } else {
                    Toast.makeText(RegisterActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Register> call, Throwable t) {
                Toast.makeText(RegisterActivity.this, t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}