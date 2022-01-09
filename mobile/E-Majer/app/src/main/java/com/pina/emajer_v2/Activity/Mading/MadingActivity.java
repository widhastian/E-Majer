package com.pina.emajer_v2.Activity.Mading;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;

import com.pina.emajer_v2.API.APIRequestMading;
import com.pina.emajer_v2.API.APIUtils;
import com.pina.emajer_v2.Activity.Transaksi.RiwayatTransaksi.riwayatTransaksi;
import com.pina.emajer_v2.Adapter.MadingAdapter;
import com.pina.emajer_v2.HomeActivity;
import com.pina.emajer_v2.Model.Mading.MadingData;
import com.pina.emajer_v2.Model.Mading.MadingResponse;
import com.pina.emajer_v2.ProfilActivity;
import com.pina.emajer_v2.R;
import com.pina.emajer_v2.SessionManager;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MadingActivity extends AppCompatActivity {
    SessionManager SessionManager;
    RecyclerView recyclerView;
    APIRequestMading apiRequestMading;
    String id_kelas;
    List<MadingData> madingList = new ArrayList<>();
    ImageButton btnProfil, btnHome;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mading);

        SessionManager = new SessionManager(this);
        id_kelas = String.valueOf(SessionManager.getIdKelas());

        apiRequestMading = APIUtils.getReqMading();
        buildListMading();


        btnHome = (ImageButton) findViewById(R.id.btn_home_mading);
        btnProfil = (ImageButton) findViewById(R.id.btn_account_mading);

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(MadingActivity.this, HomeActivity.class));
            }
        });

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(MadingActivity.this, ProfilActivity.class));
            }
        });

    }

    private void initRecyclerView(){
        recyclerView = findViewById(R.id.madingRecycler);
        recyclerView.setHasFixedSize(true);
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(MadingActivity.this, LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);

    }


    public void buildListMading(){
        Call<MadingResponse> call = apiRequestMading.ambilMading(id_kelas);
        call.enqueue(new Callback<MadingResponse>() {
            @Override
            public void onResponse(Call<MadingResponse> call, Response<MadingResponse> response) {
                String message = response.body().getMessage();
                madingList = response.body().getData();
                initRecyclerView();

                MadingAdapter adapter = new MadingAdapter(getBaseContext(), madingList);
                recyclerView.setAdapter(adapter);
                adapter.notifyDataSetChanged();
//                Toast.makeText(getBaseContext(), "Pesan: "+ message, Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(Call<MadingResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(), "Gagal konek server: ", Toast.LENGTH_LONG).show();
            }
        });
    }
}