package com.kelompok.emajer;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.kelompok.emajer.Activity.Mading.MadingActivity;
import com.kelompok.emajer.Activity.Transaksi.CatatanPengeluaran.catatanpengeluaran;
import com.kelompok.emajer.Activity.Transaksi.PembayaranKas.pembayarankas;
import com.kelompok.emajer.Activity.Transaksi.RiwayatTransaksi.riwayatTransaksi;
import com.smarteist.autoimageslider.IndicatorView.animation.type.IndicatorAnimationType;
import com.smarteist.autoimageslider.SliderAnimations;
import com.smarteist.autoimageslider.SliderView;

public class HomeActivity extends AppCompatActivity {
    TextView tvNama, tvSaldo, tvBayarKas;
    ImageButton btnProfil, btnMading;
    Button btnRiwayatTransaksi, btnDataBarang, btnBayarKas, btnCatatanPengeluaran;
//    View vBayarKas;
    SessionManager SessionManager;
//    CalendarView kalendar;
    SliderView sliderView;
    int[] images = {R.drawable.iklan,
    R.drawable.iklan_2,
    R.drawable.iklan_3};


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        SessionManager = new SessionManager(this);
        tvNama = (TextView) findViewById(R.id.editTextMainName);
        btnProfil = (ImageButton) findViewById(R.id.btn_account_home);
//        tvBayarKas = (TextView) findViewById(R.id.bayar_kas);
//        vBayarKas = (View) findViewById(R.id.rectangle_14);
        btnBayarKas = (Button) findViewById(R.id.btn_bayar_kas);
        btnCatatanPengeluaran = (Button) findViewById(R.id.btn_catatan_pengeluaran);
        btnDataBarang = (Button) findViewById(R.id.btn_data_barang);
        btnRiwayatTransaksi = (Button) findViewById(R.id.btn_riwayat_transaksi);
        btnMading = (ImageButton) findViewById(R.id.btn_mading_home);
//        kalendar = (CalendarView) findViewById(R.id.calender);

        sliderView = findViewById(R.id.image_slider);
        tvNama.setText("Selamat Datang di E-Majer, " + SessionManager.getName());
//        tvSaldo.setText("Rp " + SessionManager.getSaldo());

        btnProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, ProfilActivity.class));
            }
        });

        btnBayarKas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, pembayarankas.class));
            }
        });

        btnCatatanPengeluaran.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, catatanpengeluaran.class));
            }
        });

        btnDataBarang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, databarang.class));
            }
        });

        btnRiwayatTransaksi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, riwayatTransaksi.class));
            }
        });

        btnMading.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(HomeActivity.this, MadingActivity.class));
            }
        });

        SliderAdapter sliderAdapter = new SliderAdapter(images);
        sliderView.setSliderAdapter(sliderAdapter);
        sliderView.setIndicatorAnimation(IndicatorAnimationType.WORM);
        sliderView.setSliderTransformAnimation(SliderAnimations.DEPTHTRANSFORMATION);
        sliderView.startAutoCycle();



//        tvBayarKas.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                startActivity(new Intent(HomeActivity.this, pembayarankas.class));
//            }
//        });

//        vBayarKas.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                startActivity(new Intent(HomeActivity.this, pembayarankas.class));
//            }
//        });
    }

}
