package com.kelompok.emajer;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.kelompok.emajer.API.ApiLoginRegister;
import com.kelompok.emajer.API.RetrofitClient;
import com.kelompok.emajer.Activity.Mading.MadingActivity;
import com.kelompok.emajer.Model.ResponseModel;
import com.kelompok.emajer.Model.DataModel;


import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ProfilActivity extends AppCompatActivity {
    SessionManager SessionManager;
    TextView tvNama, tvKelas;
    ImageButton btnHome, btnMading;
    Button btnKeluar, btnProfil, btnTentang, btnShare;
    private Context ctx;
    private List<DataModel> listData;
    private List<DataModel> listAkun;
    private String id_akun;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profil);

        tvNama = (TextView) findViewById(R.id.etProfilName);
        tvKelas = (TextView) findViewById(R.id.etProfilKelas);
        btnHome = (ImageButton) findViewById(R.id.btn_home_profil);
        btnMading = (ImageButton) findViewById(R.id.btn_mading_profil);
        btnKeluar = (Button) findViewById(R.id.btn_keluar);
        btnProfil = (Button) findViewById(R.id.btn_setting_profil);
        btnTentang = (Button) findViewById(R.id.btn_tentang_aplikasi);
        btnShare = (Button) findViewById(R.id.btn_share_emajer);

        SessionManager = new SessionManager(this);
        tvNama.setText(SessionManager.getName());
        tvKelas.setText(SessionManager.getKelas());

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(ProfilActivity.this, HomeActivity.class));
            }
        });

        btnMading.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(ProfilActivity.this, MadingActivity.class));
            }
        });

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               getData();
            }
        });

        btnTentang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(ProfilActivity.this, TentangAplikasiActivity.class));
            }
        });

        btnShare.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                setShare();
            }
        });
    }

    public void logout(View v){
        SessionManager.logoutSession();
        Intent intent = new Intent(ProfilActivity.this,LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NO_HISTORY);
        startActivity(intent);
        finish();

    }

    private void setShare()
    {
        Intent wa = new Intent(Intent.ACTION_SEND);
        wa.setType("text/plain");
        wa.putExtra(Intent.EXTRA_TEXT,
                "Anda dapat mendownload Aplikasi E-Majer pada URL berikut ini = " +
                        "http://ws-tif.com/e-majer/apk/E-Majer.apk");
        wa.setPackage("com.whatsapp");
        startActivity(wa);

    }

    private void getData(){
        id_akun = SessionManager.getUserId();
        ApiLoginRegister ardData = RetrofitClient.getClient1().create(ApiLoginRegister.class);
        Call<ResponseModel> ambilData = ardData.ardGetData(id_akun);

        ambilData.enqueue(new Callback<ResponseModel>() {
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {
                int kode = response.body().getKode();
                String pesan = response.body().getPesan();
                listAkun = response.body().getData();

                String varIdAkun= listAkun.get(0).getId();
                String varNamaAkun = listAkun.get(0).getNama();
                String varEmailAkun = listAkun.get(0).getEmail();
                String varUsernameAkun = listAkun.get(0).getUsername();
                String varPasswordAkun = listAkun.get(0).getPassword();
                String varKelasAkun = listAkun.get(0).getId_kelas();

                //Toast.makeText(ctx, "Kode : "+kode+" | Pesan : "+pesan+ " | Data : "+varIdLaundry+" | "+varNamaLaundry + " | "+varAlamatLaundry+" | "+varTeleponLaundry, Toast.LENGTH_SHORT).show();

                Intent kirim = new Intent(ProfilActivity.this, EditProfilActivity.class);
                kirim.putExtra("xId", varIdAkun);
                kirim.putExtra("xNama", varNamaAkun);
                kirim.putExtra("xEmail", varEmailAkun);
                kirim.putExtra("xUsername", varUsernameAkun);
                kirim.putExtra("xPassword", varPasswordAkun);
                kirim.putExtra("xKelas", varKelasAkun);
                startActivity(kirim);
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {
                Toast.makeText(ctx, "Gagal Menghubungi Server : " + t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }
}
